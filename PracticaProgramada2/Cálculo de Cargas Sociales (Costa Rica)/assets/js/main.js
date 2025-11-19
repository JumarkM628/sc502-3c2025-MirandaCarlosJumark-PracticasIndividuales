const btnCalculo = document.querySelector("#btnCalculo");
const btnCambio = document.querySelector("#btnCambio");
const inputSalario = document.querySelector("#salarioBruto");
const cargas = document.querySelector("#resultadoCargas");
const renta = document.querySelector("#resultadoRenta");
const neto = document.querySelector("#resultadoNeto");


const botonCalcular = () =>{
    btnCalculo.addEventListener("click", function(){
        console.log("Boton calcular seleccionado");

        const salario = parseFloat(inputSalario.value);

        const cargasCalc = salario*0.13;
        const rentaCalc = salario*0.10;
        const netoCalc = salario - cargasCalc - rentaCalc;

        cargas.textContent = "Cargas sociales: "+cargasCalc;
        renta.textContent = "Impuesto sobre la renta: "+rentaCalc;
        neto.textContent = "Salario neto: "+netoCalc;
    });
}

const botonCambio = () =>{
    btnCambio.addEventListener("click", function () {
        console.log("Boton cambiar presionado");

        const cambiar = document.querySelector(".TituloCargas");
        cambiar.textContent = "Calculo de Cargas Sociales Actualizado";
    });
}


 
document.addEventListener("DOMContentLoaded", function () {
    console.log("La pagina cargo");

    botonCalcular();
    botonCambio();
});
