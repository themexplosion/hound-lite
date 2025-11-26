import React, { useEffect, useState } from 'react';

export default function App() {
	const [stats, setStats] = useState(null);
	const [loading, setLoading] = useState(true);
	const [error, setError] = useState('');

	useEffect(() => {
		const url = `${houndDom.restUrl}stats`;
		fetch(url, { headers: { 'X-WP-Nonce': houndDom.nonce } })
			.then(res => { if (!res.ok) throw new Error(`HTTP ${res.status}`); return res.json(); })
			.then(setStats)
			.catch(e => setError(e.message))
			.finally(() => setLoading(false));
	}, []);


	return (
		<div className="space-y-4">
			<p>Hello there</p>
			<p className="text-gray-700">Welcome, <span className="font-medium">{houndDom.user}</span></p>
			{loading && <p className="text-gray-500">Loading…</p>}
			{error && <p className="text-red-600">Error: {error}</p>}
			{stats && (
				<section>
					<h2 className="text-xl font-semibold text-gray-800 mt-4">Site Stats</h2>
					<pre className="bg-gray-50 p-4 rounded border border-gray-200 overflow-auto">{JSON.stringify(stats, null, 2)}</pre>
				</section>
			)}
		</div>
	);
}