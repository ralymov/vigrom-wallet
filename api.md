# API documentation

## Get wallet balance

Get wallet balance.

**URL** : `/api/wallets/:id`

**URL Parameters** : `id=[integer]`

**Method** : `GET`

### Success Response

**Code** : `200 OK`

**Content example**

```json
{
    "id": 1,
    "amount": "100500",
    "currency": "RUB"
}
```

### Error Response

**Condition** : Wallet with given id doesn't exist.

**Code** : `400`

**Content** :

```json
{
    "error": "Record not found"
}
```


## Update wallet balance

Update wallet balance.

**URL** : `/api/wallets/:id`

**URL Parameters** : `id=[integer]`

**Method** : `PUT`

**Data constraints**

```json
{
    "transaction_type": "[valid transaction type code]",
    "amount": "[numeric (precision=2)]",
    "currency": "[valid currency code]",
    "reason": "[valid reason code]"
}
```

**Data example**

```json
{
    "transaction_type": "debit",
    "amount": "5.5",
    "currency": "USD",
    "reason": "stock"
}
```

### Success Response

**Code** : `200 OK`

**Content example**

```json
{
    "id": 2,
    "amount": "150.25",
    "currency": "USD"
}
```

### Error Responses

**Condition** : Validation errors.

**Code** : `422`

**Content** :

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "transaction_type": [
            "The selected transaction type is invalid."
        ]
    }
}
```
---
**Condition** : Wallet with given id doesn't exist.

**Code** : `400`

**Content** :

```json
{
    "error": "Record not found"
}
```
---
**Condition** : Negative wallet amount.

**Code** : `400`

**Content** :

```json
{
    "error": "Wallet total amount cannot be negative."
}
```
