
# React Webpack Grunt Dashboard (WordPress Plugin) — Tailwind v4 + React 19

This plugin provides a modern React 19 dashboard inside WP Admin, built with **webpack 5**, **webpack-dev-server 5.2.x (HMR)**, **Tailwind CSS v4**, and **Grunt** for auto-reload proxying.

---

## 7) Local Development

### Prerequisites
- **Node.js ≥ 18.12.0** (required by webpack-dev-server v5 and loaders)
- A local WordPress site (e.g., `http://wp.local`)
- Grunt CLI:
```bash
npm i -g grunt-cli
```

### Install dependencies
From plugin folder:
```bash
cd wp-content/plugins/react-webpack-grunt-dashboard
npm install
```

### Auto-Reload (Webpack watch + BrowserSync proxy)
```bash
export WP_PROXY_URL=http://wp.local   # change to your local WP domain
npm run dev
```
- Open your proxied admin at `http://wp.local/wp-admin` → **React Dashboard**.
- Edits in `src/` rebuild; BrowserSync reloads the page.

### HMR (Vite-like experience)
Enable dev server enqueue in **`wp-config.php`**:
```php
define('WP_DEV_SERVER', 'http://localhost:3000');
```
Run:
```bash
export WP_PROXY_URL=http://wp.local
npm run hmr
```
- JS/CSS update **in-place** via HMR; PHP changes still trigger a BrowserSync reload.

> **Dev-server host allowlist (important):**  
> webpack-dev-server ≥5.2.1 tightened the **Origin** checks for WebSocket connections (security fix). Make sure **`allowedHosts`** in `webpack.config.js` includes your WP host (e.g. `wp.local`) so HMR connects cleanly.

---

## 8) Production Build & Deployment

Build:
```bash
npm run build
```
- Outputs `dist/assets/main.js` and `dist/assets/main.css`.

Disable dev server enqueue for production:
- Comment/remove `WP_DEV_SERVER` in `wp-config.php`.

Activate/visit:
- **WP Admin → React Dashboard**.

---

## 9) Tailwind CSS v4 (with PostCSS)

Tailwind v4 uses **PostCSS plugin `@tailwindcss/postcss`** and **CSS-first configuration**:
- **`postcss.config.js`**
```js
module.exports = {
  plugins: {
    "@tailwindcss/postcss": {}
    // autoprefixer: {} // optional; Tailwind v4 integrates modern CSS features
  }
};
```

- **`src/styles.css`**
```css
@import "tailwindcss";

/* Optional: v4 CSS-first theme tokens */
@theme {
  --color-brand-600: #2563eb;
}

#rwg-dashboard-root {
  @apply bg-white border border-gray-200 p-6 rounded-md;
}
```

- Use Tailwind utilities directly in your components (e.g., `className="grid grid-cols-1 md:grid-cols-3 gap-4"`).

---

## 10) Security & Compatibility Notes

- **webpack-dev-server ≥5.2.1** patched **CVE-2025-30360** to prevent cross-origin WebSocket hijacking. You **must** configure:
  - `devServer.allowedHosts = [ 'wp.local' ]` (or your host) in `webpack.config.js`
  - Use **same-origin** proxy for BrowserSync (your WP local domain)

- **Node ≥ 18.12.0** required by **webpack-dev-server v5**, **style-loader v4**, **postcss-loader v8**, **webpack-cli v6**.

- **REST requests in WP Admin** should include `X-WP-Nonce` (provided by `wp_localize_script`) and be gated by `current_user_can('manage_options')` for admin-only data.

---

## 11) Versions Used (latest stable as of Nov 25, 2025)

```json
{
  "react": "19.2.0",
  "react-dom": "19.2.0",
  "webpack": "^5.103.0",
  "webpack-cli": "^6.0.1",
  "webpack-dev-server": "^5.2.2",
  "babel-loader": "^10.0.0",
  "@babel/core": "^7.28.5",
  "@babel/preset-env": "^7.28.5",
  "@babel/preset-react": "^7.28.5",
  "css-loader": "^7.1.2",
  "style-loader": "^4.0.0",
  "mini-css-extract-plugin": "^2.9.4",
  "postcss": "^8.5.6",
  "postcss-loader": "^8.2.0",
  "tailwindcss": "^4.1.17",
  "@tailwindcss/postcss": "^4.1.13",
  "grunt": "^1.6.1",
  "grunt-browser-sync": "^2.2.0",
  "grunt-contrib-watch": "^1.1.0",
  "grunt-shell": "^4.0.0",
  "grunt-concurrent": "^3.0.0",
  "load-grunt-tasks": "^5.1.0"
}
```

---



---

## ✅ NPM Commands & Workflow

### Install Dependencies
```bash
npm install
```

### Development Modes

#### Auto-Reload (Webpack watch + BrowserSync)
```bash
export WP_PROXY_URL=http://wp.local   # change to your local WP domain
npm run dev
```
- Starts **webpack in watch mode** and **BrowserSync proxy**.
- Open your WP Admin at `http://wp.local/wp-admin` → React Dashboard.

#### HMR (Hot Module Replacement, Vite-like)
Enable in `wp-config.php`:
```php
define('WP_DEV_SERVER', 'http://localhost:3000');
```
Run:
```bash
export WP_PROXY_URL=http://wp.local
npm run hmr
```
- Starts **webpack-dev-server** with HMR and BrowserSync proxy.
- JS/CSS updates instantly without full page reload.

### Production Build
```bash
npm run build
```
- Outputs optimized assets to `dist/assets/main.js` and `main.css`.
- Disable `WP_DEV_SERVER` in `wp-config.php` for production.

### Additional Commands
- **webpack:watch** → `npm run webpack:watch` (manual watch mode)
- **webpack:build** → `npm run webpack:build` (manual production build)
- **serve** → `npm run serve` (standalone webpack-dev-server)

---

### References
- React 19: https://react.dev/versions
- webpack: https://github.com/webpack/webpack/releases
- webpack-dev-server: https://github.com/webpack/webpack-dev-server/releases
- Tailwind v4: https://tailwindcss.com/blog/tailwindcss-v4
- PostCSS loader: https://github.com/webpack/postcss-loader/releases
- Security CVE: https://nvd.nist.gov/vuln/detail/CVE-2025-30360
