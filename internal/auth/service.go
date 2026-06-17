package auth

import (
	"strings"

	"golang.org/x/crypto/bcrypt"
)

type Service struct {
	Repository *Repository
}

func (s *Service) login(input *LoginUser) error {
	user := User{
		Email:    strings.TrimSpace(input.Email),
		Password: strings.TrimSpace(input.Password),
	}

	userfinded, err := s.Repository.findUserForEmail(user.Email)
	if err != nil {
		return err
	}

	err = bcrypt.CompareHashAndPassword([]byte(userfinded.Password), []byte(user.Password))
	return err
}

func (s *Service) createUser(input *CreateUser) error {
	user := User{
		Nome:     strings.TrimSpace(input.Nome),
		Email:    strings.TrimSpace(input.Email),
		Password: strings.TrimSpace(input.Password),
	}

	hash, err := bcrypt.GenerateFromPassword(
		[]byte(user.Password),
		bcrypt.DefaultCost,
	)

	if err != nil {
		return &ErrorInternal{
			Erro:  err.Error(),
			Local: "Service",
		}
	}

	user.Password = string(hash)
	return s.Repository.regiterUser(user)
}
