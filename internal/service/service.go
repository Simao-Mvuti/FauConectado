package service

import (
	"context"
	"fmt"
	"projeto/internal/domain"
	"projeto/internal/usecase"
	"projeto/internal/util"
	"time"

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
	ctx, cancel := context.WithTimeout(context.Background(), 5*time.Second)
	defer cancel()

	userfinded, err := s.Repository.FindUserByEmail(ctx, user.Email)
	if err != nil {
		return "", err
	}

	if err := bcrypt.CompareHashAndPassword([]byte(userfinded.Password), []byte(user.Password)); err != nil {
		return "", err
	}

	cost, err := bcrypt.Cost([]byte(user.Password))
	fmt.Println(cost)

	token, err := usecase.GerarToken(uint(userfinded.Id), userfinded.Email, userfinded.Role)

	return token, err
}

func (s *authService) CreateUser(input *domain.UserCreate) error {
	user := util.Saniticacao_create(input)
	ctx, cancel := context.WithTimeout(context.Background(), 3*time.Second)
	defer cancel()
	userfinded, err := s.Repository.FindUserByEmail(ctx, user.Email)
	if userfinded != nil && err == nil {
		return domain.ErrEmailAlreadyExists
	}

	if err != nil && err.Error() != domain.ErrUserNotFound.Error() {
		return err
	}

	hash, err := bcrypt.GenerateFromPassword(
		[]byte(user.Password),
		bcrypt.MinCost,
	)

	if err != nil {
		return err
	}

	user.Password = string(hash)
	return s.Repository.RegiterUser(ctx, user)
}
