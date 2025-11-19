const estudiantes =[
    {codigo: 1,nombre: "Carlos", apellido: "Miranda", nota: 87},
    {codigo: 2,nombre: "Ana", apellido: "Fernandez", nota: 45},
    {codigo: 3,nombre: "Felipe", apellido: "Herrera", nota: 77},
    {codigo: 4,nombre: "Daniel", apellido: "Barreto", nota: 89},
    {codigo: 5,nombre: "Samec", apellido: "Abarca", nota: 88}
];

const tbody = document.querySelector("#tbody-estudiantes");


const mostrarEstudiantes = () => {


    let contenido = "";

    estudiantes.forEach(estudiantes =>{
        contenido += `
        <tr>
                            <th></th>
                            <th scope="col">${estudiantes.codigo}</th>
                            <th scope="col">${estudiantes.nombre}</th>
                            <th scope="col">${estudiantes.apellido}</th>
                            <th scope="col">${estudiantes.nota}</th>
                        </tr>
        `
    });

    tbody.innerHTML = contenido;
}

const calcularPromedio = () =>{
    let sumaNotas = 0;

    estudiantes.forEach(estudiantes =>{
        sumaNotas += estudiantes.nota;
    });

    const promedio = sumaNotas / estudiantes.length;

    const promedioEst = document.querySelector("#promedioNotas");
    promedioEst.textContent = `Promedio general: ${promedio}`;
};








document.addEventListener("DOMContentLoaded", function(){
    console.log("La pagina cargo");

    mostrarEstudiantes();
    calcularPromedio();
});