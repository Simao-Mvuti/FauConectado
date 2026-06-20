package service

import (
	"projeto/internal/domain"
	"projeto/internal/usecase"
	"projeto/internal/util"

	"golang.org/x/crypto/bcrypt"
)

func NewAuthService(re usecase.AuthRepository) authService {
	return authService{
		Repository: re,
	}
}

type authService struct {
	Repository usecase.AuthRepository
}

func (s *authService) Login(input *domain.UserLogin) (string, error) {
	user := util.Saniticacao_login(input)

	userfinded, err := s.Repository.FindUserByEmail(user.Email)
	if err != nil {
		return "", err
	}

	if err := bcrypt.CompareHashAndPassword([]byte(userfinded.Password), []byte(user.Password)); err != nil {
		return "", err
	}

	token, err := usecase.GerarToken(uint(userfinded.Id), userfinded.Email)

	return token, err
}

func (s *authService) CreateUser(input *domain.UserCreate) error {
	user := util.Saniticacao_create(input)

	hash, err := bcrypt.GenerateFromPassword(
		[]byte(user.Password),
		bcrypt.DefaultCost,
	)

	if err != nil {
		return err
	}
	user.Password = string(hash)
	return s.Repository.RegiterUser(user)
}
