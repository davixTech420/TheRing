import Marzipano from 'marzipano';

document.addEventListener('DOMContentLoaded', () => {

    const el = document.getElementById('streetView');

    if (!el) return;

    const viewer = new Marzipano.Viewer(el);

    const scene = viewer.createScene({
        source: Marzipano.ImageUrlSource.fromString('/images/image.jpg'),
        geometry: new Marzipano.EquirectGeometry([{ width: 400 }]),
        view: new Marzipano.RectilinearView()
    });

    scene.switchTo();

});