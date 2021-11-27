import React, { useContext } from 'react'
import { Redirect } from 'react-router-dom';
import { AuthContext } from '../auth/AuthContext'

const PublicRoutes = ({ children }) => {

    const { user } = useContext(AuthContext);

    return user.logged ?
        <Redirect to="/home" /> : children
}

export default PublicRoutes