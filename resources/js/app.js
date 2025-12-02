import './bootstrap';

import React from "react";
import ReactDOM from "react-dom";
import { BrowserRouter } from "react-router-dom";

import Router from "./Routes.jsx";
import Navbar from "./components/layout/Navbar.jsx";
import { AuthProvider } from "./components/context/AuthContext.jsx";

ReactDOM.render(
    <AuthProvider>
        <BrowserRouter>
            <Navbar />
            <Router />
        </BrowserRouter>
    </AuthProvider>,
    document.getElementById("app")
);
