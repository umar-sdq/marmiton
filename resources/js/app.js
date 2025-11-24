import './bootstrap';

import React from "react";
import ReactDOM from "react-dom";
import { BrowserRouter } from "react-router-dom";

import Router from "./Routes.jsx";
import Navbar from "./components/layout/Navbar.jsx";

ReactDOM.render(
    <BrowserRouter>
        <Navbar />
        <Router />
    </BrowserRouter>,
    document.getElementById("app")
);

