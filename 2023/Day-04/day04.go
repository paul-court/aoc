package main

import (
	"bufio"
	"fmt"
	"math"
	"os"
	"slices"
	"strconv"
	"strings"
)

func check(e error) {
	if e != nil {
		panic(e)
	}
}

// Card loader.
type LineReader struct {
	line string
}

func (cl LineReader) Title() string {
	titleTokenPos := strings.Index(cl.line, ":")
	return cl.line[:titleTokenPos]
}

func (cl LineReader) WinningNums() []int {
	titleTokenPos := strings.Index(cl.line, ":")
	numsTokenPos := strings.Index(cl.line, "|")
	winningNumStr := strings.Split(cl.line[titleTokenPos:numsTokenPos], " ")
	var winningNums []int
	for _, i := range winningNumStr {
		num, _ := strconv.Atoi(i)
		if num > 0 {
			winningNums = append(winningNums, num)
		}
	}
	return winningNums
}

func (cl LineReader) GameNums() []int {
	numsTokenPos := strings.Index(cl.line, "|")
	gameNumStr := strings.Split(cl.line[numsTokenPos:], " ")
	var gameNums []int
	for _, i := range gameNumStr {
		num, _ := strconv.Atoi(i)
		if num > 0 {
			gameNums = append(gameNums, num)
		}
	}
	return gameNums
}

// Lotto Game
type LottoGame struct {
	title       string
	winningNums []int
	gameNums    []int
	Copies      int
}

func (l LottoGame) MatchNums() []int {
	var matches []int
	for _, v := range l.gameNums {
		if slices.Contains(l.winningNums, v) {
			matches = append(matches, v)
		}
	}
	return matches
}

func (l LottoGame) Points() int {
	mn := l.MatchNums()
	return int(math.Pow(2, float64(len(mn)-1)))
}

func countWinners(cards []LottoGame) {
	for _, card := range cards {

	}
}

func main() {
	file, err := os.Open("input.txt")
	check(err)

	partOneTotal := 0
	var deck []LottoGame

	scanner := bufio.NewScanner(file)
	for scanner.Scan() {
		lr := LineReader{scanner.Text()}
		game := LottoGame{lr.Title(), lr.WinningNums(), lr.GameNums(), 0}
		deck = append(deck, game)
		partOneTotal = partOneTotal + game.Points()
	}

	fmt.Printf("Part 1: %d\n", partOneTotal)

}
