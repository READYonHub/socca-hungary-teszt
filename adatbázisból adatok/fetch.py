import requests as req

file = open("direct-links.txt")

links = []
for line in file:
    links.append(line.strip())

writeFile = open("jatekosDB.csv", "w", encoding="UTF-8")
for link in links:
    resp = req.get(link)
    resp.encoding = "utf-8"
    final = resp.text.strip().split("\n")
    writeFile.write(",".join(final) + "\n")
    print(f"{final[2]} Written: \n" + ",".join(final) + "\n\n")
writeFile.close()