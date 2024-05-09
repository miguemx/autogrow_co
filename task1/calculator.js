function appendToDisplay(value) {
    if ( document.getElementById('display').value != "0" ) {
        document.getElementById('display').value += value;
    }
    else {
        document.getElementById('display').value = value;
    }
}

function clearDisplay() {
    document.getElementById('display').value = '0';
}

function calculate() {
    try {
        const result = eval(document.getElementById('display').value);
        document.getElementById('display').value = result;
    } catch (error) {
        document.getElementById('display').value = 'Error';
    }
}
  