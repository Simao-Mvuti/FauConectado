package auth

import (
	"time"

	"github.com/go-playground/validator/v10"
)

type Validater struct {
	Validate *validator.Validate
}

var TIMEOUT_DB = 4 * time.Minute
