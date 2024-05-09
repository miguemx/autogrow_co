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



const slider1 = document.getElementById("slider1");
const slider2 = document.getElementById("slider2");
const slider3 = document.getElementById("slider3");
const totalOutput = document.getElementById("totalValue");
const appointment = document.getElementById("appointment");
const returns = document.getElementById("return");

// Function to calculate and update the total value
function updateTotal() {
  const total = parseInt(slider1.value) + parseInt(slider2.value) + parseInt(slider3.value);
  const app = Math.floor (total / 9);
  const ret = Math.ceil(total*2.5);
  totalOutput.innerHTML = "$ " + total;
  appointment.innerHTML = app;
  returns.innerHTML = ret + " %";
}

// Initialize total value
updateTotal();



// 

document.getElementById("slider1").oninput = function() {
    var value = (this.value-this.min)/(this.max-this.min)*100
    this.style.background = 'linear-gradient(to right, #FBC530 0%, #FBC530 ' + value + '%, #dedede ' + value + '%, #dedede 100%)';
    updateTotal();
};

document.getElementById("slider2").oninput = function() {
    var value = (this.value-this.min)/(this.max-this.min)*100
    this.style.background = 'linear-gradient(to right, #FBC530 0%, #FBC530 ' + value + '%, #dedede ' + value + '%, #dedede 100%)';
    updateTotal();
};

document.getElementById("slider3").oninput = function() {
    var value = (this.value-this.min)/(this.max-this.min)*100
    this.style.background = 'linear-gradient(to right, #FBC530 0%, #FBC530 ' + value + '%, #dedede ' + value + '%, #dedede 100%)';
    updateTotal();
};
  