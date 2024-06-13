file = open("links.txt")

ids = []

for line in file:
    for segment in line.split(", "):
        ids.append(f"https://docs.google.com/presentation/export?format=txt&id={segment.split("/")[5]}")

# print(ids)

tofile = open("direct-links.txt", "w")

for link in ids:
    tofile.write(f"{link}\n")

print("write done")

# segment.split("/")[5]
# https://docs.google.com/presentation/export?format=txt&id=1i60Ijh1eyvxll3tIuDKtd39W0fiHJqrO-cul4m4-6rY