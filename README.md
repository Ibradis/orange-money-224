# orange-money-224

Ce package permet d'intégrer le paiement via Orange Money Web Payment API dans une application Laravel.

## 📌 Installation

### 1. Installer via Composer
Ajoutez le dépôt dans votre fichier `composer.json` :

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/Ibradis/orange-money-224"
    }
],
"require": {
    "ibradis/orange-money-224": "dev-main"
}
```

Puis exécutez :
```bash
composer update
```

### 2. Enregistrer le Service Provider
Ajoutez cette ligne dans `config/app.php` :

```php
'providers' => [
    ibradis\OrangeMoney\OrangeMoneyServiceProvider::class,
],
```

### 3. Publier la configuration

```bash
php artisan vendor:publish --tag=orange-money
```

Cela va créer un fichier `config/orange_money.php`.

### 4. Configurer les variables d'environnement
Ajoutez ces lignes à votre fichier `.env` :

```env
ORANGE_CLIENT_ID=your_client_id
ORANGE_CLIENT_SECRET=your_client_secret
ORANGE_MERCHANT_KEY=your_merchant_key
ORANGE_RETURN_URL=https://yourapp.com/success
ORANGE_CANCEL_URL=https://yourapp.com/cancel
ORANGE_NOTIF_URL=https://yourapp.com/notify
```

## 🚀 Utilisation

### 1. Effectuer un paiement

```php
use ibradis\OrangeMoney\OrangeMoney;

$orangeMoney = new OrangeMoney();
$response = $orangeMoney->createPayment('ORDER123', 1000, 'Ref123');

dd($response);
```

### 2. Vérifier l'état d'un paiement (à implémenter)
Bientôt disponible !

## 📜 Licence
Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus d’informations.

