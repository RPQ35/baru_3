function minimize(btn) {
    var parentIn = btn.parentNode.parentNode.parentNode;
    const videochild = parentIn.querySelector('video');
    const parentOut = parentIn.parentNode;

    btn.parentNode.parentNode.classList.replace('col-10', 'col-6');

    btn.classList.add('invisible');
    parentIn.classList.replace('flex-column-reverse', 'flex-row')
    parentOut.classList.replace('flex-column', 'flex-row');
    videochild.classList.remove('col-10', 'col-xl-8');
    videochild.classList.add('col-5', 'col-xl-2');
    videochild.controls = false;
    videochild.pause();
}

function tester(tesam) {
    const childElement = tesam;
    var parentIn = childElement.parentNode;
    const parentOut = parentIn.parentNode;

    parentIn.querySelector('div').classList.replace('col-6', 'col-10');
    parentIn.querySelector('div').lastElementChild.querySelector('svg').classList.remove('invisible');

    parentIn.classList.replace('flex-row', 'flex-column-reverse')
    parentOut.classList.replace('flex-row', 'flex-column');
    childElement.classList.remove('col-5', 'col-xl-2');
    childElement.classList.add('col-10', 'col-xl-8');
    childElement.controls = true;

    // var buttonparent = parentNode.querySelector('button[funct="OpenModal"]');
}