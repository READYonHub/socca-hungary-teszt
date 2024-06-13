insertData = []

with open("jatekosDB_final.csv", 'r', encoding='utf-8') as file:
    for line in file:
        segments = line.strip().split(',')
        validity_date = segments[0]
        name = segments[1]
        registration_number = segments[2]
        status = segments[3]

        insertData.append(
            f"INSERT INTO `players_data` (`player_id`, `name`, `registration_number`, `validity_date`, `status`, `suspension_start_date`, `suspension_end_date`, `profile_pic`) "
            f"VALUES (NULL, '{name}', '{registration_number}', '{validity_date}', '{status}', NULL, NULL, '');"
        )

with open("insertDatabase.txt", "w", encoding='utf-8') as tofile:
    for data in insertData:
        tofile.write(f"{data}\n")

print("write done")
