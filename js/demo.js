const canvas = document.getElementById("canvas");
const ctx = canvas.getContext("2d");
const fpsElement = document.getElementById("fps");
const posElement = document.getElementById("pos");
const angElement = document.getElementById("ang");

canvas.addEventListener("keydown", (e) => {
	key[e.key] = true;
});
canvas.addEventListener("keyup", (e) => {
	key[e.key] = false;
});

canvas.addEventListener("mousemove", (e) => {
	mousePos.x = e.x - canvas.getBoundingClientRect().x;
	mousePos.y = e.y - canvas.getBoundingClientRect().y;
})

const img = ctx.createImageData(canvas.width, canvas.height);
for (let i = 0; i < img.data.length; i++) {
	img.data[i + 3] = 255;
}

console.log(canvas.width, canvas.height);

const SCREEN_WIDTH = canvas.width;
const SCREEN_HEIGHT = canvas.height;
const SCREEN_RATIO = SCREEN_WIDTH / SCREEN_HEIGHT;
const FOG_START = 1;
const FOG_DISTANCE = 5;
const CEILING_HEIGHT = 1;

const map = [
	[1, 1, 1, 1, 1],
	[1, 0, 1, 0, 1],
	[1, 1, 0, 1, 1],
	[1, 0, 0, 0, 0],
	[1, 0, 1, 0, 1],
	[1, 1, 1, 1, 1],
];
const key = {};
const mousePos = {
	x: 0,
	y: 0
};

const Y_HALF_POV = toRad(90 / 2);
const SPEED = 2;
const LOOK_SPEED = 120;
let camPos = new Vector(2.5, 0.5, 2.5);
let xAngle = 0, yAngle = 0;
let moveVec = new Vector(0, 0, 0);
let bobTime = 0;

function getMap(x, y) {
	if (isNaN(x) || x < 0 || x >= map[0].length || isNaN(y) || y < 0 || y >= map.length) {
		return -1;
	}
	return map[y][x];
}

function move(moveVec, deltaTime) {
	const ang = Math.atan2(moveVec.z, moveVec.x) + toRad(-yAngle);
	const fact = Math.min(1, moveVec.getLength());
	camPos.x += SPEED * fact * Math.cos(ang) * deltaTime;
	camPos.z += SPEED * fact * Math.sin(ang) * deltaTime;

	bobTime += 12 * fact * deltaTime;
	camPos.y = 0.05 * Math.sin(bobTime) + 0.6;
}

function lookUp(deltaTime) {
	xAngle += LOOK_SPEED * deltaTime;
}

function lookLeft(deltaTime) {
	yAngle += LOOK_SPEED * -deltaTime;
}

function handleInput(deltaTime) {
	moveVec.x = 0;
	moveVec.z = 0;
	if (key["w"]) {
		moveVec.z += 1;
	}
	if (key["s"]) {
		moveVec.z -= 1;
	}
	if (key["a"]) {
		moveVec.x -= 1;
	}
	if (key["d"]) {
		moveVec.x += 1;
	}

	if (key["ArrowUp"]) {
		lookUp(deltaTime);
	}
	if (key["ArrowDown"]) {
		lookUp(-deltaTime);
	}
	if (key["ArrowLeft"]) {
		lookLeft(deltaTime);
	}
	if (key["ArrowRight"]) {
		lookLeft(-deltaTime);
	}
}

xPos = 10;
zPos = 10;

let fpsCount = 0;
let fpsTime = 0;

function renderLoop(deltaTime) {
	handleInput(deltaTime);
	clearScreen(img);

	move(moveVec, deltaTime);
	
	const zCos = Math.cos(toRad(yAngle));
	const zSin = Math.sin(toRad(yAngle));
	for (let y = 0; y < SCREEN_HEIGHT; ++y) {
		const yScreenF = -(y - SCREEN_HEIGHT / 2) / (SCREEN_HEIGHT / 2);
		const yScreenAngle = Y_HALF_POV * yScreenF;
		const yy = Math.sin(yScreenAngle);// + toRad(xAngle) * zCos);
		//const flatDepth = Math.abs(CEILING_HEIGHT / yy);
		let flatDepth = 0;
		if (yy < 0) {
			flatDepth = Math.abs(camPos.y / yy);
		} else {
			flatDepth = Math.abs((CEILING_HEIGHT - camPos.y) / yy);
		}

		if (flatDepth > FOG_DISTANCE) continue;
		const fog = 1 - (Math.max(0, flatDepth - FOG_START) / (FOG_DISTANCE - FOG_START));

		for (let x = 0; x < SCREEN_WIDTH; ++x) {
			const pixelIndex = (y * canvas.width + x) * 4;
			const xScreenF = (x - SCREEN_WIDTH / 2) / (SCREEN_WIDTH / 2);
			const xScreenAngle = Y_HALF_POV * SCREEN_RATIO * xScreenF;

			let xWorld = flatDepth * zSin + flatDepth * xScreenAngle * zCos;
			let zWorld = flatDepth * zCos - flatDepth * xScreenAngle * zSin;
			//xWorld = xWorld * Math.cos(toRad(xAngle) * zSin);
			//zWorld = zWorld * Math.sin(toRad(xAngle) * zCos);
			xWorld += camPos.x;
			zWorld += camPos.z;
			xWorld = Math.floor(xWorld * 8) / 8;
			zWorld = Math.floor(zWorld * 8) / 8;

			//if (Math.floor(xWorld) % 4 == 0 || Math.floor(zWorld) % 4 == 0) continue;
			//if (Math.floor(xWorld) % 3 >= 1 && Math.floor(zWorld) % 3 >= 1) continue;
			//if (Math.floor(xWorld) % 2 == Math.floor(zWorld) % 2) continue;
			switch (getMap(Math.floor(xWorld), Math.floor(zWorld))) {
				case 0:
					putPixel(img, pixelIndex, 128 * fog, 128 * fog, 128 * fog);
					break;
				case 1:
					putPixel(img, pixelIndex, xWorld * 255 % 255 * fog, zWorld * 255 % 255 * fog, 0); 
					break;
				default:
					putPixel(img, pixelIndex, xWorld * 255 % 255 * fog, zWorld * 255 % 255 * fog, 96 * fog); 
			}
		}
	}
	ctx.putImageData(img, 0, 0);

	posElement.textContent = "X: " + camPos.x.toFixed(2) + ", Y: " + camPos.y.toFixed(2) + ", Z: " + camPos.z.toFixed(2);
	angElement.textContent = "X: " + xAngle.toFixed(2) +  " (" + toRad(xAngle).toFixed(2) + "), Y: " + yAngle.toFixed(2) + " (" + toRad(yAngle).toFixed(2) + ")";
	fpsCount++;
	if (fpsTime > 1) {
		fpsElement.textContent = fpsCount + " FPS";
		fpsCount = 0;
		fpsTime -= 1;
	}
	fpsTime += deltaTime;
}

function guh() {
	for (let y = 0; y < map.length; ++y) {
		for (let x = 0; x < map[0].length; ++x) {
			map[y][x] = Math.random() < 0.5 ? 1 : 0;
		}
	}
}

let lastTime = 0;
function loop(timestamp) {
	const deltaTime = (timestamp - lastTime) / 1000;
	lastTime = timestamp;
	if (deltaTime < 1) {
		renderLoop(deltaTime);
	}
	window.requestAnimationFrame(loop);
}
loop();

