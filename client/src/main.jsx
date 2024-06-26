import React from 'react'
import ReactDOM from 'react-dom/client'
import { Provider } from 'react-redux'
import App from './App.jsx'
import "./index.css"
import { RouterProvider, BrowserRouter as Router, Routes, Route } from 'react-router-dom'
import Login from "./pages/Login.jsx"
import Register from './pages/Register.jsx'
import VerifyEmail from './pages/VerifyEmail.jsx'
import InitInformation from './pages/InitInformation.jsx'
import InternalServerError from './pages/InternalServerError.jsx'
import store from './redux/store.js'
ReactDOM.createRoot(document.getElementById('root')).render(
  <Provider store={store}>
    <Router>
      <Routes>
        <Route path="/*" exact element={<App/>}></Route>
        <Route path="/login" exact element={<Login/>}></Route>
        <Route path="/register" exact element={<Register/>}></Route>
        <Route path="/verify" exact element={<VerifyEmail/>}/>
        <Route path="/initinformation" exact element={<InitInformation/>}/>
        <Route path="/internalservererror" exact element={<InternalServerError/>}/>
      </Routes>
    </Router>
  </Provider>
)
