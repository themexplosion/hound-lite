import React from 'react';
import { createRoot } from 'react-dom/client';
import '../styles.css'; // Import Tailwind CSS

// Import your dashboard component
import HoundDashboard from './HoundDashboard';

// Render into a DOM node you'll place via PHP or template
const mount = document.getElementById('hound-dashboard-root');
if (mount) {
	const root = createRoot(mount);
	root.render(<HoundDashboard />);
}