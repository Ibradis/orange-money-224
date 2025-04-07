# Orange Money Laravel Package

Ce package Laravel permet d'intégrer le service de paiement Orange Money Web Payment API (Sandbox) dans votre application.

## Installation

Vous pouvez installer ce package via Composer :

```sh
composer require ibradis/orange-money:*@dev
```

Si vous utilisez une installation manuelle dans `vendor`, ajoutez cette ligne dans `composer.json` de votre projet :

```json
"repositories": [
    {
        "type": "path",
        "url": "vendor/ibradis/orange-money"
    }
]
```

## Configuration

Publiez la configuration :

```sh
php artisan vendor:publish --tag=orange-money-config"
```

Puis, ajoutez vos informations Orange Money dans le fichier `.env` :

```ini
ORANGE_CLIENT_ID=ton_client_id
ORANGE_CLIENT_SECRET=ton_client_secret
ORANGE_MERCHANT_KEY=ta_clef_merchant
ORANGE_RETURN_URL=https://ton-site.com/success
ORANGE_CANCEL_URL=https://ton-site.com/cancel
ORANGE_NOTIF_URL=https://ton-site.com/notify
ORANGE_BASE_URL=https://api.orange.com/orange-money-webpay/dev/v1
```

## Utilisation

### Initialisation du service

Dans votre contrôleur ou service :

```php
use Ibrahima\OrangeMoney\OrangeMoney;

$orangeMoney = new OrangeMoney();
```

### Utilisation
## Générer un Token d'authentification :

```php
use Ibradis\OrangeMoney\OrangeMoney;

$orange = new OrangeMoney();
$token = $orange->getAccessToken();
```

### Créer un paiement :

```php
$orange = new OrangeMoney();

$response = $orange->createPayment(
    orderId: 'CMD-20250407-001',
    amount: 1000,
    reference: 'Paiement Facture 001'
);

// Rediriger l'utilisateur vers la page de paiement
return redirect($response['payment_url']); // https://api.orange.com/orange-money-webpay/dev/v1/checkout/checkout/checkout
```

### Vérifier le statut d'une transaction : :

```php
$orange = new OrangeMoney();

$status = $orange->checkStatus(
    orderId: 'CMD-20250407-001',
    amount: 1000,
    payToken: 'XXXXXX' // Token reçu lors du paiement
);
```

### Exemples Laravel Controller :
```php
use Ibradis\OrangeMoney\OrangeMoney;

class PaiementController extends Controller
{
    public function paiement()
    {
        $orange = new OrangeMoney();
        $payment = $orange->createPayment('CMD-001', 2000, 'Commande 001');
        return redirect($payment['payment_url']);
    }

    public function callback()
    {
        // Traitement après paiement
    }
}

```

### A propos
## Développé par Ibradis
## Package Laravel - Intégration Orange Money API

### Contribution
## Les contributions sont les bienvenues !

## Fork le dépôt

## Créez une branche feature

## Faites un pull request
