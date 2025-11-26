import './styles.css';
import React from 'react';
import { createRoot } from 'react-dom/client';
import App from './App';

function mount() {

	// const rootId = (typeof houndDom !== 'undefined' && houndDom.rootId)
	// 	? houndDom.rootId : 'hound-dashboard-root';
	const rootId = 'hound-dashboard-root';
	const el = document.getElementById(rootId);
	if (!el) return;
	createRoot(el).render(<App />);
}

document.addEventListener('DOMContentLoaded', mount);

if (module && module.hot) {
	module.hot.accept('./App', () => mount());
}
