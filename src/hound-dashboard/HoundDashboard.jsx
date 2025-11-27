import { useState } from 'react';
import { __ } from '@wordpress/i18n';

export default function HoundDashboard() {
  const [count, setCount] = useState(0);

  return (
    <div className="p-6 bg-gray-100 min-h-screen">
      <div className="max-w-4xl mx-auto">
        <h1 className="text-3xl font-bold text-gray-800 mb-6">{ __('Hound Dashboard', 'hound-lite') }</h1>
        
        <div className="bg-white rounded-lg shadow-md p-6">
          <h2 className="text-xl font-semibold text-gray-700 mb-4">{ __('Welcome to Hound Search', 'hound-lite') }</h2>
          <p className="text-gray-600 mb-4">
            { __('This is your WordPress AJAX search plugin dashboard. Configure your search settings here.', 'hound-lite') }
          </p>
		  
          
          <div className="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
            <p className="text-blue-700">
              { __('Tailwind CSS is now working! This styled component is using Tailwind classes.', 'hound-lite') }
            </p>
          </div>
          
          <div className="flex items-center space-x-4">
            <button 
              onClick={() => setCount(c => c + 1)}
              className="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition-colors duration-200"
            >
              { __('Increment Counter', 'hound-lite') }
            </button>
            <span className="text-lg font-medium text-gray-700">{ __('Count:', 'hound-lite') } {count}</span>
          </div>
          
          <div className="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div className="bg-gray-50 p-4 rounded-lg">
              <h3 className="text-lg font-medium text-gray-800 mb-2">{ __('Search Statistics', 'hound-lite') }</h3>
              <p className="text-gray-600">{ __('View detailed analytics about your search usage.', 'hound-lite') }</p>
            </div>
            <div className="bg-gray-50 p-4 rounded-lg">
              <h3 className="text-lg font-medium text-gray-800 mb-2">{ __('Search Settings', 'hound-lite') }</h3>
              <p className="text-gray-600">{ __('Configure how your search functionality works.', 'hound-lite') }</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}