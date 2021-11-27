import React, { useContext } from 'react'
import { Redirect, useLocation } from 'react-router-dom';
import { AuthContext } from '../auth/AuthContext'

const PrivateRoutes = ({ children }) => {

    const { user } = useContext(AuthContext);
    const { pathname, search } = useLocation();

    localStorage.setItem('lastPath', pathname + search);

    return user.logged ?
        children : <Redirect to="/login" />
}

export default PrivateRoutes
