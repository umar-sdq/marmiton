import './bootstrap';

import React from "react";
import ReactDOM from "react-dom";
import Router from "./Routes.jsx";
import Navbar from './components/layout/Navbar.jsx';
ReactDOM.render(
    <Navbar />,
    <Router />,
    document.getElementById("app")
);
