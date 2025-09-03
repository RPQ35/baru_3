const keyboardContainer = document.getElementById("keyboard");
const keys = [
    ..."1234567890",
    ..."QWERTYUIOP",
    ..."ASDFGHJKL",
    ..."ZXCVBNM"
];

// Buat tombol satu-satu dari array
keys.forEach(char => {
    const btn = document.createElement("button");
    btn.type = "button";
    btn.className = "btn btn-outline-secondary m-1 key";
    btn.textContent = char;
    btn.onclick = () => {
        const input = document.getElementById("vehicleInput");
        input.value += char;
    };
    keyboardContainer.appendChild(btn);
});

// Tombol spasi
const spaceBtn = document.createElement("button");
spaceBtn.type = "button";
spaceBtn.className = "btn btn-outline-secondary m-1";
spaceBtn.textContent = "Space";
spaceBtn.onclick = () => {
    const input = document.getElementById("vehicleInput");
    input.value += " ";
};
keyboardContainer.appendChild(spaceBtn);

// Tombol hapus
const backspaceBtn = document.createElement("button");
backspaceBtn.type = "button";
backspaceBtn.className = "btn btn-outline-danger m-1";
backspaceBtn.textContent = "⌫";
backspaceBtn.onclick = () => {
    const input = document.getElementById("vehicleInput");
    input.value = input.value.slice(0, -1);
};
keyboardContainer.appendChild(backspaceBtn);
