import sys
import pdfplumber
import mysql.connector

# Get the PDF file path from command line
pdf_file = sys.argv[1]

# Connect to MySQL database
db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="user_management"
)
cursor = db.cursor()

# Clear existing data
cursor.execute("DELETE FROM timetable")
db.commit()

# Open the PDF
with pdfplumber.open(pdf_file) as pdf:
    current_class = None

    for page in pdf.pages:
        text = page.extract_text()
        lines = text.split('\n')

        # Step 1: Detect the class name at top
        for line in lines:
            if ("BCS-" in line) or ("BSE-" in line) or ("AI-" in line):
                current_class = line.strip()
                break  # Only first occurrence per page

        # Step 2: Now extract tables
        tables = page.extract_tables()

        for table in tables:
            if not table:
                continue

            current_day = None

            for row in table:
                # Clean empty or bad rows
                if not row or len(row) < 6:
                    continue

                row = [cell.strip() if cell else '' for cell in row]

                if row[0] in ['Mo', 'Tu', 'We', 'Th', 'Fr']:
                    current_day = row[0]

                    for i in range(1, 6):  # Assuming 5 periods
                        content = row[i]
                        course = ""
                        faculty = ""
                        room = ""

                        if content:
                            parts = content.split("\n")
                            if len(parts) > 0:
                                course = parts[0]
                            if len(parts) > 1:
                                faculty = parts[1]
                            if len(parts) > 2:
                                room = parts[2]

                        sql = "INSERT INTO timetable (class_name, day, time_slot, course, faculty, room) VALUES (%s, %s, %s, %s, %s, %s)"
                        values = (current_class, current_day, str(i), course, faculty, room)
                        cursor.execute(sql, values)

db.commit()
cursor.close()
db.close()

print("Timetable extracted and saved successfully!")
