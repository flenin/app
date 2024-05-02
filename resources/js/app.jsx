import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();

import {createRoot} from 'react-dom/client';
import Booking from './booking';

const domNode = document.getElementById('root');
const root = createRoot(domNode);

root.render(<Booking {...domNode.dataset} />);
