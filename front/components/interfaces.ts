export interface BookInterface {
	id: string
	title: string
	slug: string
}

export interface BookProps {
  book: BookInterface,
  firstParagraph: ParagraphInterface
}

export interface ParagraphInterface {
  id: string
  number: number
  text: string
  encounters: EncouterInterface[]
  linkedParagraphs: LinkedParagraphInterface[]
  book: BookInterface
}

export interface ParagraphCompInterface {
  id: string
  number: number
  text: string
  encounters: EncouterInterface[]
  linkedParagraphs: LinkedParagraphInterface[]
  book: BookInterface
  handleClick: (number: number) => void
}

export interface EncouterInterface {
  name: string
  dexterity: number
  toughness: number
}

export interface LinkedParagraphInterface {
  text: string
  paragraph: number
}

export interface GameInterface {
  id: string
  book: BookInterface
  paragraph: ParagraphInterface
}

export interface AdventureInterface {
  id: string
  book: BookInterface
  paragraph: ParagraphInterface
}

export interface AdventureProps {
  adventure: AdventureInterface
}
