const keyboardContainer = document.getElementById("keyboard");

// Keyboard cuma setengah layar bawah
keyboardContainer.style.position = "fixed";
keyboardContainer.style.bottom = "0";
keyboardContainer.style.left = "0";
keyboardContainer.style.width = "100vw";
keyboardContainer.style.height = "30vh";
keyboardContainer.style.background = "#f8f9fa";
keyboardContainer.style.display = "flex";
keyboardContainer.style.flexDirection = "column";
keyboardContainer.style.padding = "10px";
keyboardContainer.style.boxShadow = "0 -3px 10px rgba(0,0,0,0.2)";

// Keyboard Rows
const keyRows = [
    "1234567890",
    "QWERTYUIOP",
    "ASDFGHJKL",
    "ZXCVBNM"
];

keyRows.forEach(row => {
    const rowDiv = document.createElement("div");
    rowDiv.style.display = "flex";
    rowDiv.style.flex = "1";

    [...row].forEach(char => {
        const btn = document.createElement("button");
        btn.type = "button";
        btn.textContent = char;

        // Style tombol
        btn.style.flex = "1";
        btn.style.margin = "3px";
        btn.style.fontSize = "1.5rem";
        btn.style.borderRadius = "8px";
        btn.style.border = "1px solid #6c757d";
        btn.style.background = "#fff";

        btn.onclick = () => {
            const input = document.getElementById("vehicleInput");
            input.value += char;
        };
        rowDiv.appendChild(btn);
    });

    keyboardContainer.appendChild(rowDiv);
});

// Baris terakhir (space & backspace)
const controlRow = document.createElement("div");
controlRow.style.display = "flex";
controlRow.style.flex = "1";

const spaceBtn = document.createElement("button");
spaceBtn.type = "button";
spaceBtn.textContent = "Space";

spaceBtn.style.flex = "3";
spaceBtn.style.margin = "3px";
spaceBtn.style.fontSize = "1.5rem";
spaceBtn.style.borderRadius = "8px";
spaceBtn.style.border = "1px solid #6c757d";
spaceBtn.style.background = "#fff";

spaceBtn.onclick = () => {
    const input = document.getElementById("vehicleInput");
    input.value += " ";
};
controlRow.appendChild(spaceBtn);

const backspaceBtn = document.createElement("button");
backspaceBtn.type = "button";
backspaceBtn.textContent = "⌫";

backspaceBtn.style.flex = "1";
backspaceBtn.style.margin = "3px";
backspaceBtn.style.fontSize = "1.5rem";
backspaceBtn.style.borderRadius = "8px";
backspaceBtn.style.border = "1px solid #dc3545";
backspaceBtn.style.background = "#fff";
backspaceBtn.style.color = "#dc3545";

backspaceBtn.onclick = () => {
    const input = document.getElementById("vehicleInput");
    input.value = input.value.slice(0, -1);
};
controlRow.appendChild(backspaceBtn);

keyboardContainer.appendChild(controlRow);
