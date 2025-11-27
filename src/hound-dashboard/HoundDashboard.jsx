import { useState } from 'react';
import { __ } from '@wordpress/i18n';

export default function HoundDashboard() {
  const [activeTab, setActiveTab] = useState('general');
  const [copied, setCopied] = useState(false);

  const tabs = [
    { id: 'general', label: __('General', 'hound-lite'), icon: 'dashicons-admin-generic' },
    { id: 'search-config', label: __('Search Configuration', 'hound-lite'), icon: 'dashicons-search' },
    { id: 'styling', label: __('Styling', 'hound-lite'), icon: 'dashicons-art' },
    { id: 'advanced', label: __('Advanced', 'hound-lite'), icon: 'dashicons-admin-tools' },
  ];

  const renderContent = () => {
    switch (activeTab) {
      case 'general':
        return (
          <div className="space-y-6">
            <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
              <h2 className="text-xl font-semibold text-gray-800 mb-4">{__('Welcome to Hound Search', 'hound-lite')}</h2>
              <p className="text-gray-600 mb-4">
                {__('This is your WordPress AJAX search plugin dashboard. Configure your search settings here.', 'hound-lite')}
              </p>

              <div className="relative">
                {copied && (
                  <div className="absolute -top-8 right-0 bg-green-100 text-green-700 text-xs font-medium px-2 py-1 rounded border border-green-200 shadow-sm transition-opacity duration-300">
                    {__('Shortcode copied!', 'hound-lite')}
                  </div>
                )}
                <div className="bg-gray-50 border border-gray-200 rounded-md p-4 mb-6 flex items-center justify-between">
                  <code className="text-sm font-mono text-gray-700 bg-gray-100 px-2 py-1 rounded border border-gray-300">
                    [themexplosion_hound]
                  </code>
                  <button
                    onClick={() => {
                      navigator.clipboard.writeText('[themexplosion_hound]');
                      setCopied(true);
                      setTimeout(() => setCopied(false), 2000);
                    }}
                    className="ml-4 text-sm text-blue-600 hover:text-blue-800 font-medium focus:outline-none"
                  >
                    {__('Copy', 'hound-lite')}
                  </button>
                </div>
              </div>
            </div>
          </div>
        );
      case 'search-config':
        return (
          <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <h2 className="text-xl font-semibold text-gray-800 mb-4">{__('Search Configuration', 'hound-lite')}</h2>
            <p className="text-gray-600">{__('Configure how your search functionality works.', 'hound-lite')}</p>
            {/* Placeholder for future settings */}
            <div className="mt-4 p-4 bg-gray-50 rounded border border-gray-100">
              <p className="text-sm text-gray-500 italic">{__('Search settings will be implemented here.', 'hound-lite')}</p>
            </div>
          </div>
        );
      case 'styling':
        return (
          <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <h2 className="text-xl font-semibold text-gray-800 mb-4">{__('Styling', 'hound-lite')}</h2>
            <p className="text-gray-600">{__('Customize the appearance of your search results.', 'hound-lite')}</p>
            <div className="mt-4 p-4 bg-gray-50 rounded border border-gray-100">
              <p className="text-sm text-gray-500 italic">{__('Styling options will be implemented here.', 'hound-lite')}</p>
            </div>
          </div>
        );
      case 'advanced':
        return (
          <div className="space-y-6">
            <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
              <h2 className="text-xl font-semibold text-gray-800 mb-4">{__('Advanced Settings', 'hound-lite')}</h2>
              <div className="mt-4 p-4 bg-gray-50 rounded border border-gray-100">
                <p className="text-sm text-gray-500 italic">{__('Advanced options will be implemented here.', 'hound-lite')}</p>
              </div>
            </div>

            <div className="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
              <h3 className="text-lg font-medium text-gray-800 mb-2">{__('Search Statistics', 'hound-lite')}</h3>
              <p className="text-gray-600">{__('View detailed analytics about your search usage.', 'hound-lite')}</p>
            </div>
          </div>
        );
      default:
        return null;
    }
  };

  return (
    <div className="bg-gray-100 min-h-screen font-sans p-8">
      <div className="max-w-5xl mx-auto flex items-start gap-8">
        {/* Sidebar */}
        <div className="w-64 bg-white rounded-xl shadow-sm border border-gray-200 flex-shrink-0 sticky top-8">
          <div className="p-6 border-b border-gray-100">
            <h1 className="text-2xl font-bold text-gray-800 flex items-center gap-2">
              <span className="dashicons dashicons-search text-blue-600"></span>
              {__('Hound', 'hound-lite')}
            </h1>
          </div>
          <nav className="p-4 space-y-2">
            {tabs.map((tab) => (
              <button
                key={tab.id}
                onClick={() => setActiveTab(tab.id)}
                className={`w-full flex items-center space-x-3 px-4 py-3 text-left rounded-lg transition-all duration-200 ${activeTab === tab.id
                  ? 'bg-blue-50 text-blue-700 font-medium shadow-sm'
                  : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                  }`}
              >
                <span className={`dashicons ${tab.icon} ${activeTab === tab.id ? 'text-blue-600' : 'text-gray-400'}`}></span>
                <span>{tab.label}</span>
              </button>
            ))}
          </nav>
        </div>

        {/* Main Content */}
        <div className="flex-1">
          <div className="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
            <header className="mb-8 pb-4 border-b border-gray-100">
              <h1 className="text-3xl font-bold text-gray-900">
                {tabs.find(t => t.id === activeTab)?.label}
              </h1>
            </header>
            {renderContent()}
          </div>
        </div>
      </div>
    </div>
  );
}