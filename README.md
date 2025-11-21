# VMS
Bootstrap link:
https://getbootstrap.com/docs/5.3/getting-started/introduction/

The html body should be sth like:
```html
<body>
        <div class="d-flex">
            <?= sidebarShow("/*currentTab*/"); ?>
            <!--Main div==============================================================================-->
            <div class="container-fluid content flex-grow-1 p-5">
                //Code here==========
                
            </div>
        </div>
</body>
```
Call `sideBarShow()` to insert sidebar html code

**password = 000+host_id/guest_id, e.g. host_id:101 password: 000101**

TODO list:
-------
- [V] selection query
- [V] join query
- [ ] division query
- [ ] aggregation query
- [ ] nested aggregation with group by
- [v] delete operation
- [v] update operation

# More update

## 1. autoCreatedNewId($role)

This function makes a new ID depending on role.

### How to use:
```php
$newId = autoCreatedNewId("host");
```

### Parameters:
- `"host"` → ID < 600  
- `"guest"` → ID >= 600  

### What it does:
- Looks at the biggest existing ID in “host” or “guest”
- Returns the next number + 1

---

## 2. Password Hashing

Before saving password to database, hash it:

```php
$hashedPass = password_hash($password, PASSWORD_DEFAULT);
```

To check password during login:

```php
password_verify($inputPassword, $hashFromDB);
```

---

## 3. Sign Up Flow (Host Example)

Full example of how sign-up works:

```php
$newId = autoCreatedNewId('host');
$hashedPass = password_hash($_POST['signUpPassword'], PASSWORD_DEFAULT);

$sql = "INSERT INTO host (host_id, host_address, host_phone_num, password)
        VALUES (:id, :addr, :phone, :pwd)";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $newId);
$stmt->bindParam(':addr', $signUpAddr);
$stmt->bindParam(':phone', $signUpPhone);
$stmt->bindParam(':pwd', $hashedPass);
$stmt->execute();
```

---

## 4. Login Verification

Checking user login:

```php
$sql = "SELECT * FROM host WHERE host_id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$data = $stmt->fetch();

if (password_verify($inputPassword, $data["password"])) {
    // success
}
```

---

## 5. How To Import the Functions

Add at the top of any PHP file that needs these functions:

```php
require_once "functionSet.php";
```

Then you can call:

```php
autoCreatedNewId("guest");
getNextEvent($pdo, $userId);
```

---

## Notes

- Host IDs must remain under 600.
- Guest IDs must remain 600 or above.
- Always hash passwords; never store plain text.

---
