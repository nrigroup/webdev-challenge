const path = require("path")
const withTM = require("next-transpile-modules")([
  "swagger-ui-react",
  "react-syntax-highlighter",
  "swagger-client",
])

/** @type {import('next').NextConfig} */
const nextConfig = {
  reactStrictMode: true,
  swcMinify: true,
  webpack(config) {
    config.resolve.alias = {
      ...config.resolve.alias,
      "@styles": path.resolve(__dirname, "styles"),
    }
    return config
  },
}

module.exports = withTM(nextConfig)
