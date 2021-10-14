const createMouseCircle = () => {
    const circle = document.createElement('figure');
    circle.classList.add('mouse-circle');
    window.onmousemove = function (event) {
        moveWithMouse(circle, event);
    };
    document.body.appendChild(circle);
};
const moveWithMouse = (target, event) => {
    target.style.left = event.clientX - target.clientWidth / 2 + 'px';
    target.style.top = event.clientY - target.clientHeight / 2 + 'px';
};
createMouseCircle();
