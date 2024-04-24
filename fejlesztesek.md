# FELDATOK:

❌ cimsor átírás - fölösleges, ugyis belső adminisztrálásra lesz használva
* posztok törlésekor, illetve játékosok törlésekor legyen egy megerősítéses popup
* log fajlt adatbazisba logoljon
* a feltölthető képeknek kell vlm szabály, hogy mennyi legyen a képfelbontás, méret, tb. megkell szabni
* szuresnel a megjelenitendo adatoknal a szamok nem jelennek meg
* a kulonbozo success/edit/delete uzenetek zold/sarga/piros szinnel jelenjenek meg
* sok adatnal eloszor a tablazat jelenik meg (a regi) és csak utána a jquery szerinti datatables stilus, wtf?!
* qr decoder-t összekéne építeni már
* qr-kód átírányítás után jelenjen meg pl. egy public mappában csak az az egy játékos kártya vagy játékos egészségügyi adat (ennek a logikáját még ki kell találni)
* a megadott grafika szerinte jelenjen meg még a hírek is
  
    ## Űrlapok:
    (autocomplete="off", strtolower("ksibetusit"), required, strip_tags("tagek ellen"), ucfirst("elso betu nagybetu")), trim("folos szokoz")

    ### Adminisztrátor résznél
      ✅ az admin regisztrálásnál az e-mail-t át kell alakítani, hogy ha helytelen a begépelt formátum, kis betűsen jelenjen meg minden esetben
      ✅ ne lehessen üres tartalmat bevinni
      ✅ admin törlésénél megerősítő üzenet küldése
      * success create uzenetek megjelenitése alertben/modal - rosszul jelenik meg próbáld ki
      * tartalmazni a jelszónak kell kis és nagybetűt, különleges karaktert és számot (nem tudom hová lett belőle a regex)
      ✅ ne lehessen <> karaktert használni
    
    ### Hírek résznél
      * success create uzenetek megjelenitése alertben/modal - rosszul jelenik meg próbáld ki
      ✅ cim, összefoglaló, poszt mondat kezdő betűje nagybetű (ucfirst())
      ✅ ne lehessen <> karaktert használni
      ✅ torlesnel jelenjen meg egy megerosítő popup
  

     ### Játékos résznél
      * success create uzenetek megjelenitése alertben/modal - rosszul jelenik meg próbáld ki
      * ne lehessen <> karaktert használni

# FRONTEND:

* sidebar fixalasa
* gombok stilusozása, méretezése
* logput gomb sidebar alsó részén fixálása

# BIZTONSÁG

* ✅ lapvédelem, ne tudjak belépni, ha ismerem a fájl strukturát, csak ha be vagyok jelentkezve



# TESZTEK:

* ✅ linkek ellenőrzése
* lapvédelem ellenőrzése

## admin resz

  ### uj admin
  ### admin edit


## hirek resz

  ### uj hirek
  ### meglevo hirek


## jatekos resz

  ### uj jatekos
  ### meglevo jatekos
  ### jatekos egesszsegugy
    *  http://192.168.1.110/socca-hungary-teszt/admin/players/players_health.php nem reszponziv

# KÉSZ 

✅ email cím ellenőrzése (regex)
✅ naplózás (email, ip)
✅ admin letrehozas, modositas, torles, megtekintes
✅ qr kod genralas vlm logika szerint - PHP-ban
✅ képfeltöltés
✅ kereso beszurasa -konnyebb navigacióval keressük meg azt a játékosokat
✅ oldalon megjeleno adatok korlátozása

