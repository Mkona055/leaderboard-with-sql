# LAB9 - normal



## Q1a: Test des formes normales

```
R=(A,B,C,D)
F={
AB ⇒ C,
C ⇒ D,
D ⇒ A
}
```



a. Clés candidates : BA. BC, BD

b. On a C  ⇒ D et C n'est pas une super clé  donc R n'est pas BCNF

de plus D n'est pas une super clé donc R n'est pas 3NF

## Q1b: Test des formes normales

## 

```
R=(A,B,C,D)
F={
A ⇒ B,
B ⇒ C,
C ⇒ D,
D ⇒ A
}
```

a. Clés candidates : A, B, C, D

b. OUI on est dans 3NF et BCNF tous les attributs sont des clés candidates et donc des superclés.







## Q1c: Test des formes normales

```
R=(A,B,C,D)
F={
B ⇒ C,
C ⇒ A 
C ⇒ D 
}
```

a. Clés candidates : B,

b. Non on est pas dans 3NF ni dans BCNF



## Q1d: Test des formes normales

```
R=(A,B,C,D)
F={
ABC ⇒ D,
D ⇒ A 
}
```

a. Clés candidates : ABC

b. Non on est pas dans 3NF ni dans BCNF

## Q1e: Test des formes normales

```
R=(A,B,C,D)
F={
A ⇒ C
B ⇒ D 
}
```

a. Clés candidates : AB

b. Non on est pas dans 3NF ni dans BCNF

## Q2a: Test de la dépendance fonctionnelle

## 

```
R=(A,B,C,D,E,F)
F={
AB ⇒ C,
BC ⇒ AD,
D ⇒ E,
CF ⇒ B
}
```

Est AB ⇒ D valide ? Si oui, montrez une preuve formelle; sinon, donnez un contre-exemple.

```
AB ⇒ C 
AB ⇒ BC  (augmentation)
AB ⇒ AD  (transitivité)
AB ⇒ D (décomposition)

Donc oui c'est valide.

```

## Q2b: Test de la dépendance fonctionnelle

```
R=(A,B,C)
F={
AB ⇒ C
}
```

Est ce A ⇒ C valide ? Si oui, montrez une preuve formelle; sinon, donnez un contre-exemple.

Voici un contre-exemple.

|  A   |  B   |  C   |
| :--: | :--: | :--: |
|  0   |  1   |  3   |
|  0   |  2   |  4   |
|  1   |  1   |  5   |
|  1   |  2   |  6   |



## Q2c: Test de la dépendance fonctionnelle

```
R=(A,B,C)
F={
AB ⇒ C
}
```

Est ce B ⇒ C valide ? Si oui, montrez une preuve formelle; sinon, donnez un contre-exemple.

Voici un contre-exemple.

|  A   |  B   |  C   |
| :--: | :--: | :--: |
|  0   |  1   |  3   |
|  0   |  2   |  4   |
|  1   |  1   |  5   |
|  1   |  2   |  6   |

## Q2d: Test de la dépendance fonctionnelle

```
R=(A,B,C)
F={
AB ⇒ C
}
```

Est A ⇒ C OR B ⇒C valide ? Si oui, montrez une preuve formelle; sinon, donnez un contreexemple.

D'après les deux dernières questions on peut conclure que NON.

## Q3: Couverture canonique

```
F={
B ⇒ A,
D ⇒ A,
AB ⇒ D
}
```

(B)+ = (ABD) donc B ⇒ D on peut supprimer A.

```
F={
B ⇒ A,
D ⇒ A,
B ⇒ D
}
```
```
F={
B ⇒ AD,
D ⇒ A,
}
```