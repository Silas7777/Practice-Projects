let container = document.querySelector(".container");
let gridButton = document.getElementById("submit-grid");
let ClearGridButton = document.getElementById("clear-grid");
let gridWidth = document.getElementById("width-range");
let gridHeight = document.getElementById("height-range");
let colorButton = document.getElementById("color-input");
let eraseBtn = document.getElementById("erase-btn");
let paintBtn = document.getElementById("paint-btn");
let widthValue = document.getElementById("width-value");
let heightValue = document.getElementById("height-value");

let events = {
    mouse: {
        down: "mousedown",
        move: "mousemove",
        up: "mouseup"
    },
    touch: {
        down: "touchstart",
        move: "touchmove",
        up: "touchend"
    }
};

let deviceType = "";
let draw = false;
let erase = false;

const isTouchDevice = () => {
    try {
        document.createEvent("TouchEvent");
        deviceType = "touch";
    } catch (e) {
        deviceType = "mouse";
    }
};
isTouchDevice();

const getPointerPosition = (e) => {
    if (deviceType === "touch") {
        return {
            x: e.touches[0].clientX,
            y: e.touches[0].clientY
        };
    } else {
        return {
            x: e.clientX,
            y: e.clientY
        };
    }
};

gridButton.addEventListener("click", () => {
    container.innerHTML = "";

    for (let i = 0; i < gridHeight.value; i++) {
        let row = document.createElement("div");
        row.classList.add("gridRow");

        for (let j = 0; j < gridWidth.value; j++) {
            let col = document.createElement("div");
            col.classList.add("gridCol");

            col.setAttribute("id", `gridCol-${i}-${j}`);

            col.addEventListener(events[deviceType].down, (e) => {
                e.preventDefault();
                draw = true;
                paintCell(col);
            });

            col.addEventListener(events[deviceType].move, (e) => {
                if (!draw) return;

                let pos = getPointerPosition(e);
                let element = document.elementFromPoint(pos.x, pos.y);

                if (element && element.classList.contains("gridCol")) {
                    paintCell(element);
                }
            });

            col.addEventListener(events[deviceType].up, () => {
                draw = false;
            });

            row.appendChild(col);
        }

        container.appendChild(row);
    }
});

function paintCell(element) {
    if (erase) {
        element.style.backgroundColor = "transparent";
    } else {
        element.style.backgroundColor = colorButton.value;
    }
}

ClearGridButton.addEventListener("click", () => {
    container.innerHTML = "";
});

eraseBtn.addEventListener("click", () => erase = true);
paintBtn.addEventListener("click", () => erase = false);

gridWidth.addEventListener("input", () => {
    widthValue.textContent = gridWidth.value.padStart(2, "0");
});

gridHeight.addEventListener("input", () => {
    heightValue.textContent = gridHeight.value.padStart(2, "0");
});

window.onload = () => {
    gridHeight.value = 0;
    gridWidth.value = 0;
};