function generateRandomIdAndSet() {
    const randomId = generateRandomId(8); // Adjust the length as needed
    document.getElementById('userID').value = randomId;
}
function generateRandomId(length) {
    let result = '';
    const numbers = '0123456789';

    for (let i = 0; i < length; i++) {
        result += numbers.charAt(Math.floor(Math.random() * numbers.length));
    }

    return result;
}