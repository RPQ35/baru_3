const keyboardContainer = document.getElementById("keyboard");
const keyRows = [
    "1234567890",
    "QWERTYUIOP",
    "ASDFGHJKL",
    "ZXCVBNM"
];

// Loop per row
keyRows.forEach(row => {
    const rowDiv = document.createElement("div");
    rowDiv.className = "d-flex justify-content-center mb-2";

    [...row].forEach(char => {
        const btn = document.createElement("button");
        btn.type = "button";
        btn.className = "btn btn-outline-secondary mx-1 key";
        btn.textContent = char;
        btn.onclick = () => {
            const input = document.getElementById("vehicleInput");
            input.value += char;
        };
        rowDiv.appendChild(btn);
    });

    keyboardContainer.appendChild(rowDiv);
});

// Baris terakhir untuk spasi & backspace
const controlRow = document.createElement("div");
controlRow.className = "d-flex justify-content-center mt-2";

const spaceBtn = document.createElement("button");
spaceBtn.type = "button";
spaceBtn.className = "btn btn-outline-secondary mx-1";
spaceBtn.style.minWidth = "150px"; // bikin space agak panjang
spaceBtn.textContent = "Space";
spaceBtn.onclick = () => {
    const input = document.getElementById("vehicleInput");
    input.value += " ";
};
controlRow.appendChild(spaceBtn);

const backspaceBtn = document.createElement("button");
backspaceBtn.type = "button";
backspaceBtn.className = "btn btn-outline-danger mx-1";
backspaceBtn.textContent = "⌫";
backspaceBtn.onclick = () => {
    const input = document.getElementById("vehicleInput");
    input.value = input.value.slice(0, -1);
    // memotong string dari awal sampai karakter terakhir (hapus 1 karakter terakhir).
};
controlRow.appendChild(backspaceBtn);

keyboardContainer.appendChild(controlRow);
