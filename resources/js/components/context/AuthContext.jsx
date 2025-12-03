import { createContext, useState } from "react";

export const AuthContext = createContext();

export function AuthProvider({ children }) {
    const [isLoggedIn, setIsLoggedIn] = useState(!!localStorage.getItem("token"));
    const [role, setRole] = useState(localStorage.getItem("role") || "USER");

    const login = (token, userRole) => {
        localStorage.setItem("token", token);
        localStorage.setItem("role", userRole);
        setIsLoggedIn(true);
        setRole(userRole);
    };

    const logout = () => {
        localStorage.removeItem("token");
        localStorage.removeItem("role");
        setIsLoggedIn(false);
        setRole("USER");
    };

    return (
        <AuthContext.Provider value={{ isLoggedIn, role, login, logout }}>
            {children}
        </AuthContext.Provider>
    );
}
