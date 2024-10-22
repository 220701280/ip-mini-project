async function signup() {
    const username = document.getElementById('new-username').value;
    const password = document.getElementById('new-password').value;

    const response = await fetch('db.php?action=signup', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ username, password }),
    });

    if (response.ok) {
        alert('User registered successfully!');
        window.location.href = 'index.html';
    } else {
        alert('Error registering user');
    }
}

async function login() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    const response = await fetch('db.php?action=login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ username, password }),
    });

    if (response.ok) {
        window.location.href = 'convert.html';
    } else {
        alert('Invalid credentials');
    }
}

async function convertCurrency() {
    const amount = parseFloat(document.getElementById('amount').value);
    const currency = document.getElementById('currency').value;

    const response = await fetch('db.php?action=convert', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ amount, currency }),
    });

    if (response.ok) {
        const result = await response.json();
        document.getElementById('result').innerText = `Converted Amount: ${result.convertedAmount.toFixed(2)} ${currency}`;
    } else {
        alert('Error during conversion');
    }
}
