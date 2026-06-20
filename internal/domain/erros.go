package domain

import "errors"

var ErrUserNotFound = errors.New("user not found")
var ErrEmailAlreadyExists = errors.New("emal duplicate")
var ErorConfigureVariabel = errors.New("Variáveris de ambiente vázios")
var InvalidedToken = errors.New("token inválido")
