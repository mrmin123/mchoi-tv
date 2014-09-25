#!/usr/bin/python

from datetime import datetime
import json
import urllib

class GetGameCounts(object):
    def __init__(self):
        url = 'https://api.twitch.tv/kraken/games/top?limit=5'
        self.top = self.twitchQuery(url)
        self.top10 = []
    def getTopTen(self):
        if self.top.has_key('top') and len(self.top['top']) > 0:
            for entry in self.top['top']:
                self.getCounts(entry['game']['name'])
                self.top10.append(entry['game']['name'])
                
    
    def getCounts(self, game_clean):
        if game_clean in self.top10:
            pass
        else:
            game_dirty = game_clean.replace(' ', '+')
            outline = "|||||" + game_clean + "|||"
            url = 'https://api.twitch.tv/kraken/streams?game=' + game_dirty + '&offset=0&limit=8'
            answer = self.twitchQuery(url)
            if answer.has_key('streams') and len(answer['streams']) > 0:
                for stream in answer['streams']:
                    outline = outline + stream['channel']['display_name'] + ";" + stream['channel']['name'] + ";" + str(stream['viewers']) + "|"
            print outline
    
    def twitchQuery(self, url):
        f = urllib.urlopen(url)
        a = f.read()
        return json.loads(a)

def main():
    getData = GetGameCounts()
    getData.getTopTen()
    getData.getCounts('League of Legends')
    getData.getCounts('Dota 2')
    getData.getCounts('StarCraft: Brood War')

if __name__ == "__main__":
	main()
