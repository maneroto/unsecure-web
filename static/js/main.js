const server = axios.create({
    header: {
        'Content-Type': 'application/json',
    },
    baseURL: '/unsecure-web/server/routes/',
});

const newTag = ({
    tagName,
    target = undefined,
    textContent = undefined,
    className = undefined,
} = {}) => {
    const tag = document.createElement(tagName);
    if (textContent != undefined) tag.textContent = textContent;
    if (className != undefined) tag.className = className;
    if (target != undefined) target.appendChild(tag);
    return tag;
};

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
