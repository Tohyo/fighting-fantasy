export interface EncouterInterface {
  name: string
  dexterity: number
  toughness: number
  resolveEncounter: (encounter: EncouterInterface) => void
}
