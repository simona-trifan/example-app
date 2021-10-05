<?php

namespace App\Dto;

use App\Interfaces\DtoInterface;

class TokenDto implements DtoInterface
{
    /**
     * @var string|null
     */
    protected $accessToken;

    /**
     * @var int|null
     */
    protected $expiresIn;

    /**
     * @var string|null
     */
    protected $tokenType;

    /**
     * TokenDto constructor.
     * @param string|null $accessToken
     * @param int|null $expiresIn
     * @param string|null $tokenType
     */
    public function __construct(?string $accessToken, ?int $expiresIn = null, ?string $tokenType = null)
    {
        $this->accessToken = $accessToken;
        $this->expiresIn = $expiresIn ?? config('jwt.ttl');
        $this->tokenType = $tokenType ?? 'Bearer';
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'access_token' => $this->getAccessToken(),
            'expires_in' => $this->getExpiresIn(),
            'token_type' => $this->getTokenType(),
        ];
    }

    /**
     * @return string|null
     */
    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    /**
     * @param string|null $accessToken
     * @return TokenDto
     */
    public function setAccessToken(?string $accessToken): TokenDto
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getExpiresIn(): ?int
    {
        return $this->expiresIn;
    }

    /**
     * @param int|null $expiresIn
     * @return TokenDto
     */
    public function setExpiresIn(?int $expiresIn): TokenDto
    {
        $this->expiresIn = $expiresIn;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTokenType(): ?string
    {
        return $this->tokenType;
    }

    /**
     * @param string|null $tokenType
     * @return TokenDto
     */
    public function setTokenType(?string $tokenType): TokenDto
    {
        $this->tokenType = $tokenType;
        return $this;
    }
}
