import axios from 'axios';

const { VITE_API_BASE_URL: apiBaseUrl } = import.meta.env;

const http = axios.create({
  baseURL: apiBaseUrl,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  },
});

export default http;