import React, { useContext } from 'react'
// import PropTypes from 'prop-types';
import { NavLink, Link, useHistory } from "react-router-dom";
import { AuthContext } from '../auth/AuthContext';
import { types } from '../types/types';

const Navbar = props => {

    const navigate = useHistory();
    const { dispatch } = useContext(AuthContext);


    const handleLogOut = () =>{
        const action = {
            type: types.logout
        }
        dispatch(action);
        navigate.replace('/login')
    }

    return (
        <nav className="navbar navbar-expand-md navbar-dark bg-dark">
            <div className="container-fluid">
                <Link to="/" className="navbar-brand">Home</Link>
                <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"></span>
                </button>
                <div className="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul className="navbar-nav me-auto mb-2 mb-lg-0">
                        <li className="nav-item">
                            <NavLink activeClassName="active" to="/login" className="nav-link">Login</NavLink>
                        </li>
                        <li className="nav-item">
                            <NavLink activeClassName="active" to="/users" className="nav-link">Users</NavLink>
                        </li>
                        <li className="nav-item">
                            <NavLink activeClassName="active" to="/blog" className="nav-link">Blog</NavLink>
                        </li>
                    </ul>
                    <ul className="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li className="nav-item">
                            <span className="nav-link pointer" onClick={handleLogOut}>Log Out</span>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    )
}

Navbar.propTypes = {

}

export default Navbar
