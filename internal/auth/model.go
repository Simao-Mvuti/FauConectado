package auth

import "fmt"

type User struct {
	ID       int
	Nome     string
	Email    string
	Password string
}

type CreateUser struct {
	Nome     string `json:"name" validate:"required"`
	Email    string `json:"email" validate:"required,email"`
	Password string `json:"password" validate:"required,min=5"`
}

type LoginUser struct {
	Email    string
	Password string
}

type ErrorInternal struct {
	Erro  string
	Local string
}

func (e *ErrorInternal) Error() string {
	return fmt.Sprintf("erro:%s,local:%s", e.Erro, e.Local)
}
