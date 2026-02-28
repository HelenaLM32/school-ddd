# README Principiant

## Projecte PHP · OOP · Introducció a DDD

Benvingut/da al **projecte inicial del curs**.

Aquest projecte és una **introducció progressiva** a la programació orientada a objectes i al disseny correcte d’aplicacions en PHP. No cal que ho entenguis tot des del primer dia: **l’objectiu és aprendre pas a pas**.

---

## 🎯 Què aprendràs en aquest projecte

Al llarg del projecte aprendràs a:

* Programar amb **classes i objectes** en PHP
* Entendre què és una **responsabilitat** dins del codi
* Separar dades, lògica i accions
* Escriure codi **clar, llegible i ordenat**
* Introduir-te als conceptes bàsics de **DDD (Domain-Driven Design)**

Aquest projecte és la base per a versions més avançades que farem més endavant.

---

## 🧠 Idea clau del projecte

> **Primer entenem el problema, després escrivim codi.**

No es tracta només que el programa funcioni, sinó que:

* S’entengui què fa
* Sigui fàcil de modificar
* Tingui sentit com a model

---

## 🗂️ Estructura bàsica del projecte

```
src/
├── Domain/      ← Classes principals del problema
├── Application/ ← Accions que pot fer el sistema
└── tests/       ← Proves del que desenvolupem
```

👉 De moment **no tocarem Doctrine ni arquitectura avançada**.

---

## 📦 Què hauràs de fer com a alumne/a

Durant el curs hauràs de:

* Crear classes amb atributs i mètodes
* Utilitzar constructors correctament
* Evitar variables globals
* Escriure mètodes amb sentit
* Respectar els noms i l’estructura del projecte

No cal fer-ho perfecte: **cal fer-ho bé i entendre-ho**.

---

## 🧪 Testing (introducció)

Començarem amb tests senzills per:

* Comprovar que una classe funciona
* Verificar regles bàsiques

Els tests ens ajuden a:

* Detectar errors
* Tenir més confiança en el codi

### Tests de domini amb phpunit
```
vendor/bin/phpunit --testsuite=domain
````


---

## 🚦 Normes bàsiques

* Una classe = una responsabilitat
* Noms clars millor que curts
* Mètodes petits
* Si no ho saps explicar, no està bé

---

## ❓ Preguntes habituals

**És normal si em costa?**
Sí. Estàs aprenent una forma nova de programar.

**He de saber-ho tot des del principi?**
No. El projecte creix amb el curs.

**Això serveix per a la vida real?**
Sí. És la base de projectes professionals.

---

## 🏁 Missatge final

Aquest README és només el començament.

 **Aprèn bé les bases**: després l’arquitectura avançada tindrà molt més sentit.
