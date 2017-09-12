# cli-progressionvalidator (PHP Command line progression validator)
This cli script allows you to check whether the given string is a progression (arithmetic or geometric) or not. This validator supports denominator of geometric progression and difference coefficient of arithmetic progression next types:
- integer
- double

Usage
-----

### Arithmetic progression

```
php script.php 1.11,2.12,3.13
```
Response:
```
This is an arithmetic progression with difference = 1.01
This is not an geometric progression
```

### Geometric progression:

```
 php script.php 2,4,8,16
```
Response:
```
This is not an arithmetical progression
This is an geometric progression with denominator = 2
```

### Not progression

```
 php script.php 2,4,8,23
```
Response:
```
This is not an arithmetical progression
This is not an geometric progression
```