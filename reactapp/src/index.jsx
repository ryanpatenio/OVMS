import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import App from './App';
import reportWebVitals from './reportWebVitals';
import {ImageCard} from './imagecard';

try {
  ReactDOM.render(
    <ImageCard />,
    document.getElementById('offer')
  )
} catch (error) {
  console.error("Error: ", error);
}



reportWebVitals();
