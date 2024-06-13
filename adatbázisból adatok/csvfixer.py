import csv

def fix_csv_lines(input_file, output_file, encoding='utf-8'):
    with open(input_file, 'r', newline='', encoding=encoding) as infile, open(output_file, 'w', newline='', encoding=encoding) as outfile:
        reader = csv.reader(infile)
        writer = csv.writer(outfile)
        
        for row in reader:
            fixed_row = [item for item in row if item != '']
            writer.writerow(fixed_row)

input_csv = 'jatekosDB.csv'
output_csv = 'jatekosDB_final.csv'
fix_csv_lines(input_csv, output_csv)
